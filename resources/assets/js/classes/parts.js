class Parts {
    constructor() {
        this.data = {};
        this.get();
    }
    get() {
        axios.post('/getparts')
            .then(this.onSuccess.bind(this))
            .catch(this.onFail.bind(this));
    }
    onSuccess(response){
        this.data = response.data;
    }
    onFail(error){
        this.errors.set(error.response.data);
    }
}