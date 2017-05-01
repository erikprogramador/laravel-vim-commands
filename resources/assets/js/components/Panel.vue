<template>
	<div class="panel panel-default">
		<header class="panel-heading">
			<slot name="header"></slot>
		</header>
		<main class="panel-body">
			<slot></slot>
		</main>
		<footer class="panel-footer">
			<slot name="footer"></slot>
		</footer>
	</div>
</template>

<script>
	export default {}
</script>

<style lang="scss" scoped>

</style>