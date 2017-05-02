<template>
	<modal @closed="$emit('cancel')" :isOpen="isOpen">
		<span slot="title">Update Command</span>
		<form @submit.prevent="update">
			<div class="form-group">
				<label for="title">Title:</label>
				<input type="text" class="form-control" v-model="commandInfo.title">
			</div>
			<div class="form-group">
				<label for="command">Command:</label>
				<input type="text" class="form-control" v-model="commandInfo.commandTag">
			</div>
			<div class="form-group">
				<label for="description">Description:</label>
				<textarea v-model="commandInfo.description"></textarea>
			</div>
		</form>
		<div slot="footer">
			<button class="btn btn-link btn-xs" :disabled="isUpdating" @click.prevent="$emit('cancel')">Cancel</button>
			<button class="btn btn-primary btn-xs" :disabled="isUpdating" @click.prevent="update">Update</button>
		</div>
	</modal>
</template>

<script>
	import Modal from './Modal.vue';
	export default {
		props: ['command', 'isOpen'],
		components: { Modal },
		data () {
			return {
				commandInfo: {},
				isUpdating: false
			};
		},
		methods: {
			update () {
				this.isUpdating = true;
				axios.put(`/api/command/${this.command.id}`, this.commandInfo)
					.then(({ data }) => {
						flash('Command updated with success!');
						this.isUpdating = false;
						this.$emit('updated', data);
					})
					.catch(error => {
						flash('Something went wrong when delete the command!');
						this.isUpdating = false;
					});
			}
		},
		mounted () {
			this.commandInfo = this.command;
		}
	}
</script>

<style lang="scss" scoped>

</style>