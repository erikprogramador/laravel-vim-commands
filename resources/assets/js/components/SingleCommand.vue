<template>
    <div>
        <panel>
            <div slot="header" class="flex">
                <span class="flex-1">{{ internalCommand.title }}</span>
                <strong>{{ internalCommand.command }}</strong>
            </div>
            <p>
                {{ internalCommand.description }}
            </p>
            <div slot="footer" class="text-right">
                <button class="btn btn-warning btn-xs" @click.prevent="updateCommand">Update</button>
                <button class="btn btn-danger btn-xs" @click.prevent="deleteCommand">Delete</button>
            </div>
        </panel>
    </div>
</template>

<script>
    import Panel from './Panel.vue';
    export default {
        props: ['command'],
        components: { Panel },
        data () {
            return {
                internalCommand: {},
                updating: false
            };
        },
        methods: {
            updateCommand (command) {
                this.updating = true;
            },
            deleteCommand () {
                axios.delete(`/api/command/${this.command.id}`)
                    .then(response => {
                        console.log('I will display a message!');
                    })
                    .catch(response => {
                        console.error('I will display a message!');
                    });
                this.$emit('deleted', this.command);
            },
            cancelUpdate () {
                this.updating = false;
            },
            updated (data) {
                this.internalCommand = data;
                this.updating = false;
            }
        },
        mounted () {
            this.internalCommand = this.command;
        }
    }
</script>

<style lang="scss" scoped>
    .flex {
        display: flex;
    }
    .flex-1 {
        flex: 1;
    }
</style>