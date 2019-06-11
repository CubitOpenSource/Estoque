<script src="<?= URL ?>assets/js/modal.js"></script>

<div id="modal-bg">
    <a id="close-modal" href="#"><i class="fas fa-times"></i></a>

    <div id="modal">
        <p style="text-align: center; margin-top: 3em;">Loading...</p>
    </div>
</div>

<style>
	#modal-bg {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		z-index: 99;
		background: rgba(0, 0, 0, 0.6);

		display: none;
	}

	#close-modal {
		position: absolute;
		background: white;
		width: 56px;
		height: 56px;
		margin-left: -28px;
		border-radius: 56px;
		top: 20px;
		left: 50%;
		color: red;
		font-size: 1.5em;
		font-weight: 700;
		text-align: center;
		text-decoration: none;
	}

	#modal {
		position: absolute;
		width: 85%;
		height: 70%;
		background: white;
		z-index: 100;
		top: 50px;
		left: 50%;
		margin-left: -42%;
		border-radius: 0.6em;
		overflow-y: auto;
		padding: 0.5em 0 2em 0;
	}

	@media(min-width: 1024px) {
		#modal {
			width: 60%;
			margin-left: -30%;
		}
	}
</style>