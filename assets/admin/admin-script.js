const data = {
    updateData: () => {
        const json = data.getData();
        console.log(json);
    },

     getData: async () => {
        const url = "https://api.nbp.pl/api/cenyzlota/last/5/?format=json";
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error(`Response status: ${response.status}`);
            }
            const result = await response.json();
            console.log(result);
        } catch (error) {
            console.error(error.message);
        }

    }

    
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