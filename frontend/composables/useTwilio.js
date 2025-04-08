export default () => {
    const { $axios, $toast } = useNuxtApp();

    const makeCall = async (contact) => {
        try {
            $toast.info('Iniciando chamada...');
            const response = await $axios.post(`/api/twilio/make-call/${contact.id}`);
            $toast.success('Chamada iniciada!');
            console.log(response.data);
        } catch (error) {
            $toast.error(`Erro ao fazer chamada: ${error.response?.data?.message || error.message}`);
        }
    };

    return { makeCall };
};
