require('./bootstrap');

window.Vue =require('vue')

import Vue from "vue";
//register component globally so that it can be used inside our Vue elem
Vue.component('app', require('./components/App').default);
Vue.component('site-body', require('./components/SiteBody').default);
Vue.component('site-footer', require('./components/SiteFooter').default);
Vue.component('site-header', require('./components/SiteHeader').default);
Vue.component('site-impressum', require('./components/SiteImpressum').default);
Vue.component('article-input', require('./components/ArticleInput').default);

const axios = require('axios');
const vueaxios = require('vue-axios');

let socket = new WebSocket('ws://127.0.0.1:8100/demo');
socket.onmessage=(msgVerbunden)=>{
    let msg = JSON.parse(msgVerbunden.data);
    console.log(msg.data);
    alert(msg.data)
}
let socket2 = new WebSocket('ws://127.0.0.1:8100/sold');
socket2.onmessage=(msgVerbunden)=>{
    let isAuth="false";
    let userID=0;
    axios.get('/isloggedin', {})
        .then((response) => {
            isAuth=response.data.auth;
            userID=response.data.id;
            console.log(response.data)

            if(isAuth==="true") {

                let msg = JSON.parse(msgVerbunden.data);
                console.log(msg.data[0]);
                if(userID===msg.data[0]) {
                    let message= msg.data.substring(1);
                    alert(message)
                }
                else
                    console.log("AuthID ist nicht die ID des Verkäufers")
            }
        }, (error) => {
            console.log(error);
        });
}
let socket3 = new WebSocket('ws://127.0.0.1:8100/offer');
socket3.onmessage=(msgVerbunden)=>{
    let userID=0;
    let isAuth="false"
    axios.get('/isloggedin', {})
        .then((response) => {
            userID=response.data.id;
            console.log(response.data);
            console.log(userID)
            isAuth=response.data.auth;
            let msg = JSON.parse(msgVerbunden.data);
            if(userID!==msg.data[0] || isAuth==="false") {
                console.log(msg.data[0]);
                    let message= msg.data.substring(1);
                    alert(message)
            }
            else
                console.log("AuthID ist die ID des Verkäufers")
        }, (error) => {
            console.log(error);
        });
}



Vue.use(vueaxios, axios);

const app = new Vue({
    el: '#app',
});
