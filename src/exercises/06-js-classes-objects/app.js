import Car from '/exercises/06-js-classes-objects/Car.js';

let bmw = new Car('BMW', '5 Series', 2026, 'Green', ['Sunroof', 'Heated Seats']);
let kia = new Car('kia', 'Rio', 2011, 'Silver', ['Bluetooth']);

let myCarCollection = [bmw, kia];

myCarCollection.forEach((car) => {
    console.log(`${car.make} ${car.model} extras:`, car.getExtras());
});