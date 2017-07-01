class Brends{
    constructor() {
        this.data = {};
        this.new = {};
        this.errors = new Errors();
        this.formUrl = '/brends/create';
        this.saveUrl = '/brends';
        this.showModal = false;
    }
    get(){
        axios.post('/getdevicebrends')
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
    onFail(errors){
        this.errors = errors.data;
    }
}