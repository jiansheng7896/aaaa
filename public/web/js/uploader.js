(function(w, $, q, layer){

	var Uploader =  {

		uploaders: [],

		// 统一设置文言
		lang: {
			image: {
				numError: '上传照片最多不能超过20张',
				sizeError: '图片最大不能超过5M',
				typeError: '格式错误,请上传图片',
				uploading: '图片上传中...',
				waitingUpload: '等待上传...',
			},	
			video: {
				numError: '只能上传一个视频文件',
				sizeError: '视频过大，建议拍摄不超过10秒',
				typeError: '格式错误,请上传视频文件',
				uploading: '视频上传中...',
				waitingUpload: '等待上传...',
			}
		},

		//判断是否有未上传结束的文件
		isQueue: function() {
			if (!this.uploaders) {
				return false;
			}

			var isQueue = false;
			for (var i = 0, l = this.uploaders.length; i < l; i++) {
				if (this.uploaders[i].total.queued > 0) {
					isQueue = true;
				}
			}

			return isQueue; 
		},

		//进度控制
		process: function(file, type) {
			var pcs = $('#' + file.id),
				percent = file.percent + '%',
				speed = Math.ceil(file.speed / 1024) + 'KB/s';

			var _lang =  type == 'image' ? this.lang.image : this.lang.video; 

			if (file.percent == 0) {
				pcs.find('.ms').css('height', '0%');
				pcs.find('.ms-text').html(_lang.uploading + '<br>0%'); 
			} else {
                pcs.find('.ms').css('height', percent);
                pcs.find('.ms-text').html(_lang.uploading + '<br>' + percent + '<br>' + speed);
			}
		},

		// 图片预览
		previewImage: function(file, callback) {

			if (!file || !/image\//.test(file.type)) return;

		    var preloader = new mOxie.Image();

		    preloader.onload = function() {
		        preloader.downsize(100, 100, true);
		        callback(file, preloader.getAsDataURL());
		    }

		    preloader.load( file.getSource() );
		},

		// 判断手机系统
		userAgent: function() {
			var u = w.navigator.userAgent;
		    var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
		    var isIOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端

		   	if (isAndroid) {
		   		return 'android';
		   	}
		   	if (isIOS) {
		   		return 'ios';
		   	}

		   	return 'unknown';
		},

		init: function(objs) {

			if (!objs) return;

			var _this = this;

			for(var i = 0, l = objs.length; i < l; i++) {

				var obj = objs[i];

				(function(obj) {

					if ($.inArray(obj.loader_type, ['image', 'video']) === -1) {
						return;
					}

					var Qiniu = new q();

					var _lang = _this.langE = obj.loader_type == 'image' ? _this.lang.image : _this.lang.video; 

					var itemEls = $('.' + obj.itemClass);

					var uploader = Qiniu.uploader({
						runtimes: obj.runtimes || 'html5,flash,html4',      // 上传模式，依次退化
				        browse_button: obj.browse_button,         // 上传选择的点选按钮，必需
				        uptoken_url: obj.uptoken_url,
				        domain: obj.domain,   //bucket 域名，下载资源时用到，**必需**
				        container: obj.container,             // 上传区域DOM ID，默认是browser_button的父元素
				        max_file_size: obj.max_file_size || '100mb',             // 最大文件体积限制
				        flash_swf_url: 'wechat/js/plupload/js/Moxie.swf',  //引入flash，相对路径
				        max_retries: obj.max_retries || 3,                     // 上传失败最大重试次数
				        dragdrop: obj.dragdrop || false,                     // 开启可拖曳上传
				        drop_element: obj.drop_element || '',          // 拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
				        chunk_size: obj.chunk_size || '4mb',                  // 分块上传时，每块的体积
				        auto_start: obj.auto_start || true,                   // 选择文件后自动上传，若关闭需要自己绑定事件触发上传
				        multi_selection: obj.multi_selection || false,
				        resize: obj.resize || {},
				        init: {
				            'Init': function(up) {

				            	var cte = obj.loader_type == 'image' ? 'camera' : 'camcorder';

				                $('#' + obj.container).find('input[type=file]').attr('accept', obj.loader_type + '/*')

				                //安卓手机的话在file控件上加上capture属性，要不然在微信里不能调用相机
				                if (_this.userAgent() == 'android') {
				                	$('#' + obj.container).find('input[type=file]').attr('capture', cte);
				                }
				            },
				            'FilesAdded': function(up, files) {

		               			// 判断有多少个文件通过验证了，然后移除多出来的文件
		               			var fileValidateLength = 0;

				                plupload.each(files, function(file) {
									//安卓取消上传会触发该方法，增加类型判断阻止提示
									if (!file.type) {
										return;
									}

				                    try {

				                    	// 文件数目
				                    	if (obj.max_num && $('.' + obj.itemClass).length + fileValidateLength >= obj.max_num) {
				                    		throw new Error(_lang.numError);
				                    	}	
				                    	// 文件类型
				                    	if (file.type.indexOf(obj.loader_type) < 0) {
				                    		throw new Error(_lang.typeError);
				                    	} 
				                    	// 文件大小
				                    	if (obj.max_size && (file.size > obj.max_size)) {
				                    		throw new Error(_lang.sizeError);
				                    	}

				                    	fileValidateLength++;

				                    } catch(err) {
				                        layer.msg(err.message);
				                        //移除错误文件，执行下一次循环
				                        up.removeFile(file);
				                      	return; 
				                    }
				                   	
				                   	var li = '<li class="processing ' + obj.itemClass + '" id='
			                            + file.id + '>'
			                            + '<img src="">'
			                            + '<i class="delete-image"></i>'
			                            + '<span class="ms"></span>'
			                            + '<p class="ms-text">' + _lang.waitingUpload  +'</p>'
			                            + '</li>';

					                $('#' + obj.container).before(li);
					                
				                   	if(obj.loader_type == 'image') {	
				                   		// 图片预览,这是一个异步的过程
					                   	_this.previewImage(file, function(file, imgSrc) {
					                   		$('#' + file.id).find('img').attr('src', imgSrc);
					                    })  
					                }

					                // 隐藏上传按钮
					                if ($('.' + obj.itemClass).length + files.length >= obj.max_num) {
					                  	$('#' + obj.container).hide();	
					                }

				                });

				            },
				            'BeforeUpload': function(up, file) {
				            	_this.process(file, obj.loader_type);
				                
				            },
				            'UploadProgress': function(up, file) {
					            _this.process(file,obj.loader_type);
				            },
				            'FileUploaded': function(up, file, info) {
				                //获取上传成功后的文件的Url 
				                var domain = up.getOption('domain');
				                var res = JSON.parse(info);
				                var sourceLink = domain + "/" + res.key; 

				                $('#' + file.id).removeClass('processing').addClass('uploaded').find('.ms-text').html('');

				                if (obj.loader_type == 'image') {
									var inputName = obj.input_name ? obj.input_name : "images[]";
				                	$('#' + file.id).append('<input name = "' + inputName + '" value ="' + sourceLink + '"" type="hidden">');
				                } else {
				                    $('#' + file.id).append('<input name = "images[video]" value ="' + sourceLink + '"" type="hidden">')
				                    .find('img').attr('src', sourceLink + '?vframe/jpg/offset/0/rotate/auto');
				                }

				                //触发持久化操作
				                obj.fop_url && ($.get(obj.fop_url, {key: res.key}));
				            },
				            'Error': function(up, err, errTip) {
				            	//网络错误和不知道什么的错误
				                if (err.code == '-100' || err.code == '-200') {
				                    $('#' + err.file.id).find('.ms-text')
				                        .addClass('red')
				                        .addClass('up-fail')
				                        .html('上传失败<br>点击删除'); 
				                } 
				            },
				            'UploadComplete': function() {
				                
				            },
				            'Key': function(up, file) {}
				        }
					})
					
					_this.uploaders.push(uploader);
					

				})(obj)
			}

			// 绑定删除事件
			$(w.document).on('click', '.delete-image, .up-fail', function() {
		        var self = $(this);
		        var li = self.closest('li');
		        layer.confirm('您确定删除吗?', {btn: ['确定', '取消']}, function(index) {
		            li.closest('.upload-group').find('.upload-add').show();

		            for(var i in Uploader.uploaders) {
		            	Uploader.uploaders[i].refresh();
		            }
		            
		            li.remove();
		            layer.close(index);
		        });
		    })

		},
	}

	w.uploader = Uploader;

})(window, jQuery, QiniuJsSDK, layer)