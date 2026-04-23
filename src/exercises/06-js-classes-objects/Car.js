class Car {
    constructor(_make, _model, _year, _colour, _extras = []) {
        this.make = _make;
        this.model = _model;
        this.year = _year;
        this.colour = _colour;
        this.extras = _extras;
    }

    getExtras() {
        return this.extras;
    }
}

export default Car;