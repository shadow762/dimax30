class Types {
    constructor() {
        this.data = {};
        this.new = {name:''};
        this.errors = new Errors();
        this.formUrl = '/types/create';
        this.saveUrl = '/types';
        this.showModal = false;
    }
    clear() {
        this.new = {name:''};
    }
    get() {
        axios.post('/getdevicetypes')
            .then(this.onSuccess.bind(this))
            .catch(this.onFail.bind(this));
    }
    create() {
        axios.post(this.saveUrl, this.new)
            .then(this.createSuccess.bind(this))
            .catch(this.onFail.bind(this));
    }
    createSuccess(response){
        //выводим сообщение, очищаем ошибки и данные нового элемента, обновляем список элементов
        alert(response.data.msg);
        this.clear();
        this.showModal = false;
        this.errors.clear();
        this.get();
    }
    onSuccess(response){
        this.data = response.data;
    }
    onFail(error){
        this.errors.set(error.response.data);
    }
}