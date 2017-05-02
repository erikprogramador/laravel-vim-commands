<template>
    <div class="container">
        <heading />
        <div class="row">
            <aside class="col-md-3">
                <links @resetState="resetState" @create="create" />
            </aside>
            <section class="col-md-9">
                <input class="form-control" v-model="filter" placeholder="Search by a snippet title" />
                <hr>
                <single-command v-for="command in filteredCommands" key="command.id" :command="command" @deleted="deleted" />
            </section>
        </div>
    </div>
</template>

<script>
    import Links from './Links.vue';
    import SingleCommand from './SingleCommand.vue';
    import Heading from './Heading.vue';
    export default {
        components: { Links, SingleCommand, Heading },
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
            deleted (command) {
                const index = this.commands.indexOf(command);
                const removed = this.commands.splice(index, 1);
            }
        },
        mounted () {
            axios.get('/api/commands')
                .then(({ data }) => this.commands = data);
        }
    }
</script>

<style scoped></style>
