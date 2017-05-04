<template>
    <div class="modal fade" :class="{ 'in': isOpen, 'modal-visible': isOpen }" :style="{ display: isOpen ? 'block' : 'none' }" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<header class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" @click.prevent="$emit('closed')">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">
						<slot name="title"></slot>
					</h4>
				</header>
				<main class="modal-body">
					<slot></slot>
				</main>
				<footer class="modal-footer">
					<slot name="footer"></slot>
				</footer>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['isOpen']
	}
</script>

<style lang="scss" scoped>

</style>
