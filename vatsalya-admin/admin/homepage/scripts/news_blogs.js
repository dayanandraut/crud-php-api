
// creating news Object

var News = function(title, date,header,url,story, author){
    this.id = null;
    this.title =  title;
    this.date = date;
    this.header = header;
    this.url = url;
    this.story = story;
    this.author = author;
}

// function to extract all data from forms
function getNewsDataFromForm(){
    var f = document.querySelector('#blogs_news');
    var t = f.querySelector('#title').value;
    var d = f.querySelector('#date').value;
    var h = f.querySelector('#shortDescription').value;
    var u = f.querySelector('#url').value;
    var story = $('#summernote').summernote('code');
    
    
    // get author from logged in user
    var a = "Dayanand";
    
    var news = new News(t,d,h,u,story,a);
    return news;
}

// click triggers this function
function btnWriteNews(){
    var news = JSON.stringify(getNewsDataFromForm());
    
    // debug purpose
    console.log(news);

    // url for the api
    const URL  = "http://localhost/xampp/sumant/vatsalya-admin/admin/api/news/write.php";
    const otherParam = {
        headers : {"content-type" : "application/json; charset:UTF-8"},
        body : news,
        method : "POST"
    };

    // fetch method to hit the url and get back the response
    fetch(URL, otherParam)
    .then(
        function(response) {
          if (response.status < 200 || response.status >= 300) {
            console.log('Looks like there was a problem. Status Code: ' +
              response.status);
            return;
          }    
         
          // upon successful completion of request
          response.json().then(function(data) {
            console.log("Added Successfully: "+data);
            // write code to do next
            // pop up the successful message
            // clear the input fields
            // what else do we have to do
            
          });
        }
    )
    .catch(err=>{console.log("Error occured : "+err);})
}