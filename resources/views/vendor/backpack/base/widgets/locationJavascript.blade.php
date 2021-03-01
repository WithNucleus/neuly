@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_start')
	<div class="{{ $widget['class'] ?? 'well mb-2' }}">
		<div class="alert alert-primary"><strong>{!! $widget['content'] !!}</strong></div>
	</div>

	<script>
		window.onload = function () {
			const city = document.getElementsByName('city')[0];
			const region = document.getElementsByName('region')[0];
			const country = document.getElementsByName('country')[0];
			const fullName = document.getElementsByName('name')[0];

			// Event Listeners
            city.addEventListener('input', updateName);
            region.addEventListener('input', updateName);
            //select2 use jQuery event handler
            $(country).on('change', updateName);

			function updateName(e) {
				let newName = '';
                let cityValue = city.value;
                let regionValue = region.value;
                let countryValue = country.value;

				if (cityValue) {
					newName = cityValue + ', ';
				}

				if (regionValue) {
					newName = newName + regionValue + ', ';
				}

				if (countryValue) {
					newName = newName + countryValue;
				}

                fullName.value = newName;
			}
		}
	</script>

@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_end')
