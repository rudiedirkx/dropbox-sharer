<?php

require '../env.php';

?>

<script src="https://www.dropbox.com/static/api/2/dropins.js" id="dropboxjs" data-app-key="<?= SHAR_APP_KEY ?>"></script>
<script>
window.onload = function() {
	document.body.appendChild(Dropbox.createChooseButton({
		success(files) {
			location.href = './2-select.php?shared=' + encodeURIComponent(files[0].link);
		},
		linkType: 'preview',
		multiselect: false,
		folderselect: true,
	}));
};
</script>
