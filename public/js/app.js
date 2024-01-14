//import * as pdfjsLib from 'pdfjs-dist';
//var url = 'https://raw.githubusercontent.com/mozilla/pdf.js/ba2edeae/web/compressed.tracemonkey-pldi-09.pdf';
// Loaded via <script> tag, create shortcut to access PDF.js exports.

//var pdfjsLib = window['pdfjs-dist/build/pdf'];
// The workerSrc property shall be specified.
pdfjsLib.GlobalWorkerOptions.workerSrc = false;

var pdfDoc = null,
    pageNum = getFromLocalStorage(),
    pageRendering = false,
    pageNumPending = null,
    scale = 2,
    canvas = document.getElementById('the-canvas'),
    ctx = canvas.getContext('2d');

function getLocal() {
  return JSON.parse(localStorage.getItem('pdf_progress'));
}

function hideLoader() {
  document.getElementsByClassName('loader')[0].style.display = 'none';
}

function saveToLocalStorage(num) {
  var current_storage = getLocal();
  console.log(current_storage);

  if(current_storage === null) current_storage = {};

  current_storage[file_name] = num;
  localStorage.setItem('pdf_progress', JSON.stringify(current_storage));
}

function getFromLocalStorage() {
  var current_storage = getLocal();
  if(current_storage === null) return 1;

  if(current_storage[file_name] === undefined) return 1;

  return current_storage[file_name];
}

/**
 * Get page info from document, resize canvas accordingly, and render page.
 * @param num Page number.
 */
function renderPage(num) {
  saveToLocalStorage(num);

  pageRendering = true;
  // Using promise to fetch the page
  pdfDoc.getPage(num).then(function(page) {
    var viewport = page.getViewport({scale: scale});
    canvas.height = viewport.height;
    canvas.width = viewport.width;
    canvas.style.width = "100%";
    canvas.style.height = "100%";

    // Render PDF page into canvas context
    var renderContext = {
      canvasContext: ctx,
      viewport: viewport
    };
    var renderTask = page.render(renderContext);

    // Wait for rendering to finish
    renderTask.promise.then(function() {
      
      hideLoader();

      pageRendering = false;
      if (pageNumPending !== null) {
        // New page rendering is pending
        renderPage(pageNumPending);
        pageNumPending = null;
      }
    });
  });

  // Update page counters
  const counters = document.getElementsByClassName('page_num');
  for(var i =0; i < counters.length; i++) {
    counters[i].value = num;
  }
}

/**
 * If another page rendering in progress, waits until the rendering is
 * finised. Otherwise, executes rendering immediately.
 */
function queueRenderPage(num) {
  if (pageRendering) {
    pageNumPending = num;
  } else {
    renderPage(num);
  }
}

/**
 * Displays previous page.
 */
function onPrevPage() {
  if (pageNum <= 1) {
    return;
  }
  pageNum--;

  document.getElementsByClassName('controllers top')[0].scrollIntoView();

  queueRenderPage(pageNum);
}
const prevs = document.getElementsByClassName('prev');
for(var j = 0; j < prevs.length; j++) {
  prevs[j].addEventListener('click', onPrevPage);
}

/**
 * Displays next page.
 */
function onNextPage() {
  if (pageNum >= pdfDoc.numPages) {
    return;
  }
  pageNum++;

  document.getElementsByClassName('controllers top')[0].scrollIntoView();

  queueRenderPage(pageNum);
}
const nexts = document.getElementsByClassName('next');
for(var k = 0; k < nexts.length; k++) {
  nexts[k].addEventListener('click', onNextPage);
}

/**
 * Asynchronously downloads PDF.
 */

function goToPage() {
  var selectedPage = this.parentNode.querySelector(".page_num").value;
  
  var go_to = parseInt(selectedPage);
  if(go_to > parseInt(pdfDoc.numPages)) {
    var page_nums = document.getElementsByClassName('page_num')
    for(var i = 0; i < page_nums.length; i++) {
      page_nums[i].value = pdfDoc.numPages;
    }
    go_to = parseInt(pdfDoc.numPages);
  }
  pageNum = go_to;

  document.getElementsByClassName('controllers top')[0].scrollIntoView();

  queueRenderPage(go_to);
}
var gos = document.getElementsByClassName('go');
for(var i = 0; i < gos.length; i++) {
  gos[i].addEventListener('click', goToPage); 
}

/*
var sectionHeaders = document.getElementsByClassName('toc-header').addEventListener('click', function() {
  var page_num = this.dataset.page;
  queueRenderPage(parseInt(page_num));
});*/
var sectionHeaders = document.getElementsByClassName('toc-header')
for(var i = 0; i < sectionHeaders.length; i++) {
  
  sectionHeaders[i].addEventListener('click', function() {
    var page_num = this.dataset.page;
    pageNum = page_num;

    document.getElementsByClassName('controllers top')[0].scrollIntoView();

    queueRenderPage(parseInt(page_num));
  });
}

pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
    pdfDoc = pdfDoc_;
    //document.getElementById('page_count').textContent = pdfDoc.numPages;

    var page_count = document.getElementsByClassName('page_count');
    for(var x = 0; x < page_count.length; x++) {
      page_count[x].textContent = pdfDoc.numPages;
    }
    
    // Initial/first page rendering
    renderPage(pageNum);
    });
