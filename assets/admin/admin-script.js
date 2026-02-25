const data = {
    updateData: async () => {
        const url = goldPricesAdmin.ajaxUrl;

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
            data.updateLastChange(result.lastChange);
            
        } catch (error) {
            console.error(error.message);
        }
    },

    updateLastChange: (data = false) => {
        if (!data) return;

        const dateHolder = document.querySelector('.gp--last-update-date');
        dateHolder.innerText = data;
    }
}

const updateDataButton = {
    initUpdateDataButton: () => {
        const updateDataButton = document.querySelector('.gp--btn-update-data');
        updateDataButton.addEventListener('click', data.updateData);
    }
}


window.addEventListener('load', () => {
    updateDataButton.initUpdateDataButton();
})