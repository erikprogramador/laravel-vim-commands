<template>
    <transition name="show-notification">
        <div class="alert alert-success alert-flash" role="alert" v-show="visible">
            {{ body }}
        </div>
    </transition>
</template>

<script>
    export default {
        props: ['message'],
        data () {
            return {
                body: '',
                visible: false
            };
        },
        methods: {
            flash (message) {
                this.body = message;
                this.visible = true;

                this.hide();
            },

            hide () {
                setTimeout(() => this.visible = false, 3000);
            }
        },
        created () {
            if (this.message) {
                this.flash(this.message);
            }

            window.events.$on('flash', message => this.flash(message));
        }
    }
</script>

<style lang="scss" scoped>
    .alert-flash {
        position: fixed;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        width: 90%;
        max-width: 600px;
    }

    .show-notification-enter-active, .show-notification-leave-active {
        transition: transform 300ms ease-in-out, opacity 200ms ease-in-out;
    }

    .show-notification-enter {
        transform: translateX(-50%) translateY(-100%);
        opacity: 0;
    }

    .show-notification-leave-to {
        transform: translateX(-50%) translateY(-100%);
        opacity: 0;
    }
</style>