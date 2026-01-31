const data = {
    updateData: async () => {
        const url = "http://localhost/project-wp-01/wp-admin/admin-ajax.php";
        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    action: 'save_gold_prices'
                })
            });
            if (!response.ok) {
                throw new Error(`Response status: ${response.status}`);
            }
            const result = await response.json();
            // console.log(result);
        } catch (error) {
            console.error(error.message);
        }
    },
}

const updateDataButton = {
    initUpdateDataButton: () => {
        const updateDataButton = document.querySelector('.ap--btn-update-data');
        updateDataButton.addEventListener('click', data.updateData);
    }
}

window.addEventListener('load', () => {
    updateDataButton.initUpdateDataButton();
})