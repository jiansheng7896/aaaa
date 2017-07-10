<template>
    <section>
        <div class="header">
            <i onclick="javascript:history.back()"></i>
            <span>设置</span>
        </div>
        <div class="setting-content content">
            <div class="setting-title">
                <div class="avatar">
                    <img src="img/good-img1.png">
                </div>
                <p>奢商优品奢商优品</p>
                <a class="baedeker" href="#">新手必读</a>
            </div>
            <div class="setting-item bind-phone">
                <span class="setting-item-title"><i></i>绑定手机号</span><a href="#" class="setting-item-content">18623227824<i></i></a>
            </div>
            <div class="setting-item service-phone">
                <span class="setting-item-title"><i></i>绑定银行卡</span><a href="#" class="setting-item-content">东莞农商银行（尾号0903）<i></i></a>
            </div>
            <div class="setting-item agreement">
                <span class="setting-item-title"><i></i>客服电话</span><a href="#" class="setting-item-content-s">022-84758888</a>
            </div>
            <div class="footer1">
                <router-link to="/" class="footer-item home normal">朋友圈</router-link>
                <a href="#" class="footer-item plus"></a>
                <router-link to="/user" class="footer-item mine selected">钱包</router-link>
            </div>
        </div>
    </section>
</template>
<style type="text/css">

</style>
<script type="text/ecmascript-6">
    export default{
        data(){
            return {
                statisticalLoading: false,
                recentLoading: false,
                statisticalNames: ['1','2'],
                recentNames: ['1'],
                statistical: {
                    posts: 0,
                    comments: 0,
                    post_trash: 0,
                    recent_posts:[]
                }
            }
        },
        created () {
            //this.getMeta();
        },
        methods: {
            getMeta: function () {
                let _this = this;
                _this.statisticalLoading = true;
                _this.axios.get('http://www.test.com/myp/dashboard/meta').then(function (response) {
                    let res = response.data;
                    if (res != false) {
                        _this.statistical = res;
                    } else {
                        _this.$message({
                            message: '数据获取失败',
                            type: 'error'
                        });
                    }
                    _this.statisticalLoading = false;
                }).catch(function (error) {
                    console.log(error);
                    _this.statisticalLoading = false;
                });
            },
        },
    }
</script>
