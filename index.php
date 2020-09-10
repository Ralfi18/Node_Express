var express = require("express");
var app = express();
var handleBars = require("express3-handlebars").create({ defaultLayout: "main" });

var fortunes = [
	"Conquer your fears or they will conquer you.",
	"Rivers need springs.",
	"Do not fear what you don't know.",
	"You will have a pleasant surprise.",
	"Whenever possible, keep it simple.",
];

app.engine("handlebars", handleBars.engine);
app.set("view engine", "handlebars");

app.set("port", process.env.PORT || 3000);

app.use(express.static(__dirname + "/public"));

app.get("/", function(req, res){
//	res.type("text/plain");
//	res.send("Demo App");
	res.render("home");
});

app.get("/about", function(req, res){
	//res.type("text/plain");
	//res.send("Demo App - About Page");
	var randomFortune = fortunes[Math.floor(Math.random() * fortunes.length)];

	res.render("about", { "fortune": randomFortune });
});

// 404 Page
app.use(function(req, res, next){
	// res.type("text/plain");
	res.status(404);
	res.render("404");
	//res.send("404 - Not Found");
});

// custom 500 page
app.use(function(err, req, res, next){
	console.log(err.stack)
	// res.type("text/plain");
	res.status(500);
	// res.send("500 - Server Error");
	res.render("500");
});

app.listen(app.get("port"), function(){
	console.log("Express started on http://localhots:" + app.get("port") + "; press Ctr+C to close");
});
