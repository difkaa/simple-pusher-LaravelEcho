<template>
        <li class="nav-item dropdown">
            <a href="#" id="navbarDropDown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-globe"></i> Notification
                <span class="badge badge-danger" id="count-notification" v-if="lessons.length>=25">{{ 25 }} ++ </span>
                <span class="badge badge-danger" id="count-notification" v-if="lessons.length<=25">{{ lessons.length }}</span>
                <span class="caret"></span>
            </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

            <a class="dropdown-item" href="#" v-on:click="MarkAsRead(lesson)" v-for="lesson in lessons">
                  <!-- {{ lesson.data['lesson']['username'] }} comment on {{ lesson.data['lesson']['titlethread'] }} <b>{{lesson.created_at }}</b> -->
                  {{ lesson.data['lesson']['username'] }} comment on {{ lesson.data['lesson']['titlethread'] }} {{ lesson.created_at | myOwnTime }}
                  <!-- <b>{{lesson.created_at | moment}}</b> -->


                <!-- {{ lesson.data['user']['name']}} <b>{{lesson.created_at | myOwnTime}}</b> -->
            </a>

            <div class="dropdown-divider" v-if="lessons.length!=0"></div>

            <a class="dropdown-item" href="#" v-on:click="AllMarkAsread()" v-if="lessons.length!=0">
                Read All Mark As Read
            </a>
            <a class="dropdown-item" href="#" v-if="lessons.length==0">
                No Notification
            </a>
        </div>
        </li>
</template>
<script>
    export default {

        props: ['lessons'],

        methods : {
            MarkAsRead: function(lesson){

                var data = {
                    not_id : lesson.id,
                    lesson_id : lesson.data.lesson.id,
                };

                // alert(data.not_id);

                axios.post("/markAsRead",data).then(response => {
                    window.location.href="/readLesson/" + data.lesson_id;
                });

            },

            AllMarkAsread: function(){
                axios.post('/allMarkAsread').then(response => {

                    window.location.href="/readAllLesson";

                });
            },



        },

        created() {
		this.interval = setInterval(() => this.$forceUpdate(), 1000);
 		},

        beforeDestroy() {
		clearInterval(this.interval);
	}



    };
</script>
