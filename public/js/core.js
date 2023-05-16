document.addEventListener('submit', function (e) {
    let form = e.target;
    if (form.classList.contains('ajax')) {
        e.preventDefault();
        let formData = new FormData(form);
        let method = form.getAttribute('method');
        let url = form.getAttribute('action');
        let headers = {
            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
        };

        // Search for inputs with class "form-control"
        let inputs = form.querySelectorAll('.form-control');
        inputs.forEach(function (input) {
            formData.append(input.name, input.value);
        });

        // Send Ajax request
        if (method.toLowerCase() === 'get') {
            let params = new URLSearchParams(formData).toString();
            url = url + (url.includes('?') ? '&' : '?') + params;
            axios({
                method: method,
                url: url,
                headers: headers,
            })
                .then(function (response) {
                    //#todo Исправить это
                    let tbody = document.getElementById('tbody');
                    tbody.innerHTML = '';
                    if (response.data.status === 'success') {
                        let col = 0;
                        response.data.data.forEach((item) => {
                            col++;
                            tbody.innerHTML += `
                                <tr>
                                    <th>${col}</th>
                                    <td>${item.cadastral_number}</td>
                                    <td>${item.address}</td>
                                    <td>${item.price}</td>
                                    <td>${item.area}</td>
                                </tr>
                            `
                        });
                    }

                })
                .catch(function (error) {
                    console.log(error.response.data);
                });
        } else {
            axios({
                method: method,
                url: url,
                data: formData,
                headers: headers,
            })
                .then(function (response) {
                })
                .catch(function (error) {
                    console.log(error.response.data);
                });
        }
    }
});

