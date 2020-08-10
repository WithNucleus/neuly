@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_start')
	<div class="{{ $widget['class'] ?? 'well mb-2' }}">
		<div class="alert alert-primary"><strong>{!! $widget['content'] !!}</strong></div>
	</div>

	<script>
		window.onload = function () {

			const city = document.getElementsByName('city');
			const region = document.getElementsByName('region');
			const country = document.getElementsByName('country');

			var newName = '';

			// Event Listeners
			document.getElementsByName('city')[0].addEventListener('input', updateName);
			document.getElementsByName('region')[0].addEventListener('input', updateName);
			document.getElementsByName('country')[0].addEventListener('input', updateName);

			function updateName(e) {

				document.getElementsByName('name')[0].value = '';

				var newName = '';

				var cityValue = document.getElementsByName('city')[0].value;
				var regionValue = document.getElementsByName('region')[0].value;
				var countryValue = document.getElementsByName('country')[0].value;

				if (cityValue) {
					newName = cityValue + ', ';
				}

				if (regionValue) {
					newName = newName + regionValue + ', ';
				}

				if (countryValue) {
					newName = newName + countryValue;
				}

				// Update Name Field
				document.getElementsByName('name')[0].value = newName;

			}

		}

	</script>

@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_end')