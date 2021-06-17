<template>
    <div class="menuDiv">
        <ul class="menu-outer-ul">
            <li v-for="(submenu,index) in menu" :key="index" class="menu-outer-li">
                <div>{{ index }}</div>
                <ul class="menu-inner-ul">
                    <li v-for="(element,key) in submenu" :key="key" class="menu-inner-li">
                        <div>{{ key }}</div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "site-header",
    data: function () {
        return {
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
        this.addTopic('About', {'Adresse': {}});
        this.removeTopic('Home')
        this.removeSubTopic("Unternehmen", "Karriere")
        this.addToTopic("Unternehmen", "Geschichte")
        //necessary so that the component is re-rendered
        this.$forceUpdate();
    },
    methods: {
        addTopic(newTopic, content) {
            this.menu[newTopic] = content
        },

        addToTopic(topic, content) {
            if (this.menu[topic]) {
                //push new subtopic(content) to topic
                this.menu[topic][content] = {}
            } else console.log("This topic doesnt exists")
        },

        removeTopic(topic) {
            if (this.menu[topic]) {
                delete this.menu[topic];

            } else console.log("This topic doesnt exists")
        },
        removeSubTopic(topic, subtopic) {
            if (this.menu[topic][subtopic])
                delete this.menu[topic][subtopic];
            else console.log("This topic doesnt exists")
        },
    }
}
</script>

<style scoped>

.menuDiv {
    display: flex;

}

.menu-outer-ul {
    list-style-type: none;
    width: 700px;
    margin-left: auto;
    margin-right: auto;
    margin-top: 0;
    font-size: 20px;
}

.menu-outer-ul > .menu-outer-li {
    float: left;
    padding-right: 15px;
    padding-left: 15px;
}

.menu-outer-li {
    margin-top: 7px;
    font-family: "Arial Black";

}

.menu-inner-li {
    list-style-type: square;
    font-size: large;
    font-family: Apple;
    margin-left: 8px;
    margin-top: 7px;
}

.menu-inner-ul li {
}

.menuDiv {
    display: flex;

}

.menu-outer-ul {
    list-style-type: none;
    width: 700px;
    margin-left: auto;
    margin-right: auto;
    margin-top: 0;
    font-size: 20px;
}

.menu-outer-ul > .menu-outer-li {
    float: left;
    padding-right: 15px;
    padding-left: 15px;
}

.menu-outer-li {
    margin-top: 7px;
    font-family: "Arial Black";

}

.menu-inner-li {
    list-style-type: square;
    font-size: large;
    font-family: Apple;
    margin-left: 8px;
    margin-top: 7px;
}

.menu-inner-ul li {
}
</style>
