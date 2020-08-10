<script>
	window.onload = function () {

		// Get Field Name to Listen for Updating the Slug, otherwise default to 'name'
		var field_name = @isset($widget['field_name'])'{{$widget['field_name']}}'@else'name'@endisset;

		// Set Event Listener on Name Field
		document.getElementsByName(field_name)[0].addEventListener('input', updateName);

		// Update Slug Field Function
		function updateName(e) {

			var newSlug = '';

			// Get Name
			var nameValue = document.getElementsByName(field_name)[0].value;

			// Slugify
			if (nameValue) {
				newSlug = slugify(nameValue);
			}

			// Update Slug Field
			document.getElementsByName('slug')[0].value = newSlug;

		}

		// Slugify Function
		function slugify(string) {

			const a = 'àáâäæãåāăąçćčđďèéêëēėęěğǵḧîïíīįìłḿñńǹňôöòóœøōõőṕŕřßśšşșťțûüùúūǘůűųẃẍÿýžźż·/_,:;'
			const b = 'aaaaaaaaaacccddeeeeeeeegghiiiiiilmnnnnoooooooooprrsssssttuuuuuuuuuwxyyzzz------'
			const p = new RegExp(a.split('').join('|'), 'g')

			return string.toString().toLowerCase()
				.replace(/\s+/g, '-') // Replace spaces with -
				.replace(p, c => b.charAt(a.indexOf(c))) // Replace special characters
				.replace(/&/g, '-and-') // Replace & with 'and'
				.replace(/[^\w\-]+/g, '') // Remove all non-word characters
				.replace(/\-\-+/g, '-') // Replace multiple - with single -
				.replace(/^-+/, '') // Trim - from start of text
				.replace(/-+$/, '') // Trim - from end of text
		}

	}

</script>