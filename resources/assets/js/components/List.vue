<template>
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>Vim snippets</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <links @resetState="resetState" @create="create" />
            </div>
            <div class="col-md-9">
                <input class="form-control" v-model="filter" placeholder="Search by a snippet title" />
                <hr>
                <panel v-for="command in filteredCommands" key="command.id">
                    <div slot="header" class="flex">
                        <span class="flex-1">{{ command.title }}</span>
                        <strong>{{ command.command }}</strong>
                    </div>
                    <p>
                        {{ command.description }}
                    </p>
                    <div slot="footer" class="text-right">
                        <button class="btn btn-warning btn-xs" @click.prevent="updateCommand(command)">Update</button>
                        <button class="btn btn-danger btn-xs" @click.prevent="deleteCommand(command)">Delete</button>
                    </div>
                </panel>
            </div>
        </div>
    </div>
</template>

<script>
    import Panel from './Panel.vue';
    import Links from './Links.vue';
    export default {
        components: { Panel, Links },
        data () {
            return {
                commands: [],
                filter: ''
            };
        },
        computed: {
            filteredCommands () {
                return this.commands.filter(command => command.title.toLowerCase().match(this.filter.toLowerCase()));
            }
        },
        methods: {
            resetState () {
                this.filter = '';
            },
            create () {
                console.log('create');
            },
            updateCommand (command) {
                console.log(command);
            },
            deleteCommand (command) {
                const index = this.commands.indexOf(command);
                axios.delete(`/api/command/${command.id}`)
                    .then(response => {
                        console.log('I will display a message!');
                    })
                    .catch(response => {
                        console.error('I will display a message!');
                    });
                this.commands.splice(index, 1);
            },
            getCommands () {
                axios.get('/api/commands')
                    .then(({ data }) => this.commands = data);
            }
        },
        mounted () {
            this.getCommands();
        }
    }
</script>

<style scoped>
    .flex {
        display: flex;
    }
    .flex-1 {
        flex: 1;
    }
</style>
