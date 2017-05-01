<template>
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>Vim snippets</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                Links
            </div>
            <div class="col-md-9">
                <input class="form-control" v-model="filter" placeholder="Search by a snippet title" />
                <hr>
                <panel v-for="command in filteredCommands" key="command.id">
                    <span slot="header">{{ command.title }}</span>
                    <p>
                        {{ command.description }}
                    </p>
                </panel>
            </div>
        </div>
    </div>
</template>

<script>
    import Panel from './Panel.vue';
    export default {
        components: { Panel },
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
        mounted () {
            axios.get('/api/commands')
                .then(({ data }) => this.commands = data);
        }
    }
</script>
