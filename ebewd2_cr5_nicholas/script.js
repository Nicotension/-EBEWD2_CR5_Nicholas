
function loadDoc() {
    let xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      if (this.readyState == 4 && this.status == 200) {
       document.getElementById("result").innerHTML = this.responseText;
      }
    };
    xhttp.open("GET", "ebewd2_cr5_nicholas/senior.php", true);
    xhttp.send();
  }
LoadProducts
let pets = [
    {
       image: "",
       Name : "Vincent van Goat",
       Gender: "male",
       Breed: "goat",
       Size: "Small",
       Age: 9 ,
       Vaccine: Yes,

    },
    {
        image: "",
        Name : "Vincent van Goat",
        Gender: "male",
        Breed: "goat",
        Size: "Small",
        Age: 9 ,
        Vaccine: Yes,
 
     },
     {
        image: "",
        Name : "Vincent van Goat",
        Gender: "male",
        Breed: "goat",
        Size: "Small",
        Age: 9 ,
        Vaccine: Yes,
 
     },
     {
        image: "",
        Name : "Vincent van Goat",
        Gender: "male",
        Breed: "goat",
        Size: "Small",
        Age: 9 ,
        Vaccine: Yes,
 
     },
     {
        image: "",
        Name : "Vincent van Goat",
        Gender: "male",
        Breed: "goat",
        Size: "Small",
        Age: 9 ,
        Vaccine: Yes,
 
     },
     {
        image: "",
        Name : "Vincent van Goat",
        Gender: "male",
        Breed: "goat",
        Size: "Small",
        Age: 9 ,
        Vaccine: Yes,
 
     },
];

pets.forEach(element => {
    document.getElementById("result").innerHTML += `
    <div>
      <image src="images/${element.image}">
      <p>${element.Name}</p>
      <p>${element.Gender}</p>
      <p>${element.Breed}</p>
      <p>${element.Size}</p>
      <p>${element.Age}</p>
      <p>${element.Vaccine}</p>
      </div>
    `;
});


