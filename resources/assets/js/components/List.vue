<template>
    <div class="container">
        <heading />
        <create-command @created="created" @cancelCreation="cancelCreation" :isOpen="creating"/>
        <div class="row">
            <aside class="col-md-3">
                <links @resetState="resetState" @create="create" />
            </aside>
            <section class="col-md-9">
                <input class="form-control" id="search" v-model="filter" placeholder="Search by a snippet title" />
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
    import CreateCommand from './CreateCommand.vue';
    export default {
        components: { Links, SingleCommand, Heading, CreateCommand },
        data () {
            return {
                commands: [],
                filter: '',
                creating: false
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
                this.creating = true;
            },
            created () {
                flash('Command created with success!');
                axios.get('/api/commands')
                    .then(({ data }) => this.commands = data);
            },
            cancelCreation () {
                this.creating = true;
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
