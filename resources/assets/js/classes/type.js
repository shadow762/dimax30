class Types{
    constructor() {
        this.types = {};
        this.newType = {};
        this.errors = {};
    }
    getTypes(){
        axios.post('/getdevicetypes')
            .then(this.onSuccess.bind(this))
            .catch(this.onFail.bind(this));
    }
    onSuccess(response){
        this.types = response.data;
    }
    onFail(errors){
        this.errors = errors.data;
    }
}