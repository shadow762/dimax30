class Errors{
    constructor() {
        this.errors = {};
    }
    get(field) {
        if(this.errors[field]) {
            return this.errors[field][0];
        }
    }
    set(errors) {
        this.errors = errors;
    }
    clear() {
        this.errors = {};
    }
}
