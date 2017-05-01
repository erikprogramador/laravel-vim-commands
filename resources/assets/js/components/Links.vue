<template>
	<ul class="list-group">
		<a href="#" @click.prevent="$emit('create')" class="list-group-item">Create</a>
		<a href="#" @click.prevent="$emit('resetState')" class="list-group-item">Reset Page</a>
	</ul>
</template>

<script>
	export default {}
</script>

<style lang="scss" scoped>

</style>