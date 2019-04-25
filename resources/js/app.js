require('./bootstrap');
window.Vue = require('vue');
window._ = require('lodash');
window.$ = window.jQuery = require('jquery');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('lesson', require('./components/LessonNotification.vue').default);
const app = new Vue({
    el: '#app',
    data: {
        lessons: '',
        // users: '',
    },
    created(){
        if(window.Laravel.userId) {
            axios.post('/notification/lesson/notification').then(response => {
                this.lessons = response.data;
                timeAgo();
                // this.users = response.data;

                console.log(response.data)
            });
            Echo.private('App.User.'+ window.Laravel.userId).notification((response) => {
                data = {"data":response, 'id': response.id, 'created_at': response.lesson.created_at,};
                this.lessons.push(data);
                timeAgo();
                // this.users.push(data);

                console.log(response);
            });
        };

        function timeAgo(){
            Vue.filter('myOwnTime',function(value){return moment(value).fromNow();});
        }
        this.interval = setInterval(() => this.$forceUpdate(), 1000);
    },
    beforeDestroy() {
		clearInterval(this.interval);
	}
});
