<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    let recognizable_brand = document.querySelector('#categories');
    let recognizabled_brand = document.querySelector('#brands');
    let send = document.querySelector('#send');

    recognizable_brand.addEventListener('change', function() {
        let selectedOption = this.options[this.selectedIndex];
        let selectedCategoryId = selectedOption.value;

        // alert(selectedCategoryId);
        recognizabled_brand.innerHTML = '';
        recognizabled_brand.disabled = false;
        // no = "not brand";
        // Make a GET request to your API endpoint with parameters
        axios.get('http://127.0.0.1:8000/api/select_brand', {
                params: {
                    id: selectedCategoryId
                }
            })
            .then(response => {
                // console.log(response.data.brand);
                if (response.data.success === true) {
                    response.data.brand.forEach(element => {
                        const option = document.createElement('option');
                        recognizabled_brand.classList.remove('hidden');
                        recognizabled_brand.classList.add('form-control');
                        option.classList.add('form-control');
                        option.value = element.id;
                        option.innerText = element.name;
                        recognizabled_brand.appendChild(option);
                    });
                } else {
                    // console.log('Response:', response.data);
                    const option = document.createElement('option');
                    recognizabled_brand.classList.remove('hidden');
                    recognizabled_brand.classList.add('form-control');
                    option.classList.add('form-control');
                    option.disabled = true; // Use disabled property
                    send.disabled = true; // Use disabled property
                    recognizabled_brand.disabled = true;
                    // option.innerText = no;
                    recognizabled_brand.appendChild(option);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>
