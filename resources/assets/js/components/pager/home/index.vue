<template>
    <section>
        <div class="index-content">
            <div class="title">
                <img class="qr" src="/img/qrcode.jpg">
            </div>
            <div class="i-content">
                <a class="in-out pub" href="#">
                    <i></i>
                    <p>我发布的<br>({{ data.count }})</p>
                </a>
                <a class="in-out sell" href="#">
                    <i></i>
                    <p>我的钱包<br>￥{{ data.money }}</p>
                </a>
            </div>
            <div class="ad-content">
                <img src="/img/ad-banner.png">
            </div>
            <div class="good-list-content">
                <div class="good-list-header">近期回收</div>
                <template v-for="item in goods">
                    <div class="good-list-item">
                        <div class="good-item">
                            <div class="good-img">
                                <img :src="item.avatar">
                            </div>
                            <div class="good-info">
                                <p>{{ item.category }}</p>
                                <p>{{ item.brand }}</p>
                                <p>成交价<span class="price">￥{{ item.price }}</span></p>
                            </div>
                        </div>
                        <div class="good-option trade-finish">
                        <span class="good-avatar">
                            <img :src="item.image">
                        </span>
                            <span class="good-avatar-name">{{ item.nickname }}</span>
                            <span class="auction">已拍得</span>
                            <span class="date">成交时间：{{ item.time }}</span>
                        </div>
                    </div>
                </template>
            </div>
            <div class="footer1">
                <a href="#" class="footer-item home selected">朋友圈</a>
                <a href="#" class="footer-item plus"></a>
                <router-link to="/user" class="footer-item mine normal">钱包</router-link>
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
                data: {
                    'count': 0,
                    'money': 0,
                },
                goods: [],
            }
        },
        created () {
            this.getMeta();
            this.getGoods();
        },
        methods: {
            getMeta: function () {
                let _this = this;
                _this.statisticalLoading = true;
                setTimeout(function(){
                    _this.statisticalLoading = false;
                    _this.data = {
                        'count': 112,
                        'money': 824540,
                    }
                }, 800);
//                _this.axios.get('http://www.test.com/myp/dashboard/meta').then(function (response) {
//                    let res = response.data;
//                    if (res != false) {
//                        _this.statistical = res;
//                    } else {
//                        _this.$message({
//                            message: '数据获取失败',
//                            type: 'error'
//                        });
//                    }
//                    _this.statisticalLoading = false;
//                }).catch(function (error) {
//                    console.log(error);
//                    _this.statisticalLoading = false;
//                });
            },
            getGoods: function () {
                let _this = this;
                setTimeout(function(){
                    _this.goods = [
                        {
                            'avatar' : '/img/good-img1.png',
                            'category' : '【全新】',
                            'brand' : 'Louis Vuitton/路易威登',
                            'price' : 8000,
                            'image' : '/img/good-img1.png',
                            'nickname' : '惠星辰',
                            'time' : '2016-7-12',
                        },
                    ]
                }, 800);
            }
        },
    }
</script>
