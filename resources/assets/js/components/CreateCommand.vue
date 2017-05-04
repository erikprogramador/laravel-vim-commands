<template>
	<modal @closed="cancelCreation" :isOpen="isOpen">
		<span slot="title">Update Command</span>
		<form @submit.prevent="update">
			<div class="form-group">
				<label for="title">Title:</label>
				<input type="text" class="form-control" v-model="command.title">
			</div>
			<div class="form-group">
				<label for="command">Command:</label>
				<input type="text" class="form-control" v-model="command.command">
			</div>
			<div class="form-group">
				<label for="description">Description:</label>
				<textarea class="form-control" v-model="command.description"></textarea>
			</div>
		</form>
		<div slot="footer">
			<button class="btn btn-link btn-xs" :disabled="isCreating" @click.prevent="cancelCreation">Cancel</button>
			<button class="btn btn-primary btn-xs" :disabled="isCreating" @click.prevent="create">Create</button>
		</div>
	</modal>
</template>

<script>
	import Modal from './Modal.vue';
	export default {
		props: ['isOpen'],
		components: { Modal },
		data () {
			return {
                command: {},
				isCreating: false
			};
		},
		methods: {
			create () {
                axios.post('/api/store', this.command)
                    .the(response => {
                        this.$emit('cancelCreation');
                    })
                    .catch(error => {
                        flash(error.message);
                    });
            },
            cancelCreation () {
                this.command = {};
                this.$emit('cancelCreation');
            }
		}
	}
</script>

<style lang="scss" scoped>

<
