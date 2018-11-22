get_sites();

function article_list(site_id){
  var xhr = new XMLHttpRequest();
  xhr.responseType = "json";
  xhr.open("GET", "articles.php?site=" + site_id );
  xhr.onload = function(){
    articles = xhr.response;
    var listlm = document.createElement('div');


    for( i = 0; i < articles.length; i++){
      listlm.innerHTML +=
        "<div class='listouter'>" +
          "<a href='article.html?id=" + articles[i].article_id + "'>" +
          "<img class='image' src='img_200_100.jpg'></img><div class='listtext'><h3 class='teaser'>" +
        articles[i].heading + "</h3><p class='sub_heading'>" + articles[i].sub_heading +
        "</div></a></div><div style='clear:both;'></div>";
    }
    document.body.appendChild(listlm);
  }
  xhr.send();
}


function get_sites(){
  var xhr = new XMLHttpRequest();
  xhr.responseType = "json";
  xhr.open("GET", "sites.php");
  xhr.onload = function(){
    sites = xhr.response;
    var selectsite = document.createElement('select');
    selectsite.id = 'selectsite';
    selectsite.onchange = select_site;
    defaultoption = document.createElement('option');
    defaultoption.text = "Velg publikasjon";
    defaultoption.value = 0;
    selectsite.add(defaultoption);
    for( i = 0; i < sites.length; i++){
      option = document.createElement('option');
      option.text = sites[i].site;
      option.value = sites[i].site_id;
      selectsite.add(option);
    }
    document.body.appendChild(selectsite);

  }
  xhr.send();
};

function select_site(){
  site = document.getElementById('selectsite').value;
  if (site !=0){
    article_list(site);
  }
}
