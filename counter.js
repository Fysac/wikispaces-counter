var url = 'https://wikispaces-counter-test.herokuapp.com/index.php';
var bigurl = url + '?username=' + wikispaces_username + "&space=" + wikispaces_spaceName;
document.write('<iframe src="' + bigurl +'" frameBorder="0" width="200" height="400"><\/iframe>');