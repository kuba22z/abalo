
Vue.component('site-header',{
   name:'siteheader',

    data: function(){
        return{
            menu:
        {
                'Home': {},
                'Kategorien': {},
                'Verkaufen': {},

                'Unternehmen': {
                    "Philosophie": {},
                    "Karriere": {}
                }
            },
        }
    },
    mounted() {
        this.addTopic('About',{'Adresse':{}});
        this.removeTopic('Home')
        this.removeSubTopic("Unternehmen","Karriere")
        this.addToTopic("Unternehmen","Geschichte")
        //necessary so that the component is re-rendered
        this.$forceUpdate();
    },
    methods: {
        addTopic(newTopic,content){
            this.menu[newTopic]=content
        },

        addToTopic(topic,content){
            if(this.menu[topic]) {
                //push new subtopic(content) to topic
                this.menu[topic][content] ={}
            }
            else console.log("This topic doesnt exists")
        },

        removeTopic(topic){
            if(this.menu[topic]) {
                delete this.menu[topic];

            }
            else console.log("This topic doesnt exists")
        },
        removeSubTopic(topic,subtopic){
            if(this.menu[topic][subtopic])
                delete this.menu[topic][subtopic];
            else console.log("This topic doesnt exists")
        },
    },
    template: `
        <div class="menuDiv">
        <ul class="menu-outer-ul">
            <li v-for="(submenu,index) in menu" :key="index" class="menu-outer-li">
                <div>{{index}} </div>
                <ul class="menu-inner-ul" >
                    <li v-for="(element,key) in submenu" :key="key" class="menu-inner-li">
                        <div>{{key}}</div>
                    </li>
                </ul>
            </li>
        </ul>
        </div>
        `
})

