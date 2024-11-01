<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" type="text/css">
<style>
 #main.hidden {
    display: none;
}
  #sticky-widget-container {
    position: fixed;
    bottom: 70px;
    left: 18px;
    z-index: 1050;
  }

  /* #createStickyBtn {
    background-color: #eb6f45;
    color: #fff;
    font-size: 24px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    text-align: center;
    line-height: 40px;
    cursor: pointer;
    user-select: none;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    z-index: 1010;
  } */
/* 
  #createStickyBtn:hover {
    background-color: #2980b9;
  } */

  .sticky {
    font: 20px "Short Stack", "Gloria Hallelujah", cursive;
    line-height: 1.5;
    border: 0;
    border-radius: 3px;
    background: linear-gradient(rgb(249, 239, 175), rgb(247, 233, 141));
    box-shadow: 0 4px 6px rgba(102, 102, 102, 0.1);
    width: 270px;
    min-height: 250px;
    margin: 30px;
    transition: 0.3s;
    float: left;
    display: none;
    vertical-align: top;
    z-index: 1050;
    /* Lower z-index than the dropdown menu */
  }

  .sticky:hover {
    transform: scale(1.05);
    box-shadow: 0 5px 8px rgba(0, 0, 0, 0.15);
  }

  .sticky-content::-webkit-scrollbar {
    width: 10px;
  }

  .sticky-content::-webkit-scrollbar-track {
    background: #f1f1f1;
  }

  .sticky-content::-webkit-scrollbar-thumb {
    background: #888;
  }

  .sticky-content::-webkit-scrollbar-thumb:hover {
    background: #555;
  }

  .sticky:nth-child(even) {
    transform: rotate(0deg);
  }

  .sticky:nth-child(odd) {
    transform: rotate(0deg);
  }

  .sticky-header {
    height: 30px;
    width: inherit;
    background: rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: flex-end;
    align-items: center;
    overflow: hidden;
  }

  .sticky-header-menu {
    font-weight: bold;
    padding: 10px 15px;
    box-sizing: border-box;
    display: block;
    width: 50px;
    text-align: center;
    cursor: pointer;
    position: relative;
    color:#2c302b;
  }

  .sticky-header-menu:hover {
    background-color: #557b4350;
  }

  .sticky-content {
    padding: 10px 10px 0 10px;
    overflow-y: auto;
    width: 270px;
    min-height: 250px;
    box-sizing: border-box;
    border: 0;
    resize: vertical;
    background-color: transparent;
    display: block;
    cursor: default;
  }

  .sticky-content:focus {
    outline: none;
  }

  #createStickyBtn {
        font-size: 24px;
        color: #eb6f45; /* Change to your preferred color */
        background-color: #ffffff; /* Change to your preferred background color */
        border: 1px solid #eb6f45; /* Change to your preferred border color */
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex !important;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        transition: background-color 0.3s, color 0.3s;
    }

    #createStickyBtn:hover {
        background-color: #eb6f45;
        color: #ffffff;
    }
    #createStickyBtn:hover i {
        color: #ffffff !important;
    }

    #createStickyBtn i {
        line-height: 1; 
        color: #eb6f45 
    }

  .dropdown-content-hide {
    display: none;
    position: absolute;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
    top: 30px;
    left: 0;
    width: 270px;
    box-sizing: border-box;
    justify-content: space-between;
  }

  .dropdown-content-show {
    top: 30px;
    left: 0;
  }

  .dropdown-content-hide div {
    padding: 14px 14px;
    flex: 1;
  }

  .pink-color {
    background: linear-gradient(rgb(250, 214, 231), rgb(236, 185, 209));
  }

  .blue-color {
    background: linear-gradient(rgb(175, 249, 238), rgb(150, 226, 214));
  }

  .green-color {
    background: linear-gradient(rgb(178, 249, 175), rgb(152, 228, 149));
  }

  .yellow-color {
    background: linear-gradient(rgb(249, 239, 175), rgb(247, 233, 141));
  }

  .purple-color {
    background: linear-gradient(rgb(218, 215, 250), rgb(197, 194, 232));
  }

  .drop-button {
    margin-left: auto;
  }

  .notSaved {
    display: none;
  }

  .notSaved:hover {
    background-color: transparent;
    cursor: auto;
  }

  @media (max-width: 1024px) {
    .sticky {
      line-height: 1.2;
      width: 200px;
      min-height: 180px;
      margin: 20px;
    }

    .sticky-content {
      width: 200px;
      min-height: 170px;
      font-size: 16px;
    }

    .dropdown-content-hide {
      width: 200px;
    }

    /* #createStickyBtn {
      margin: 20px;
      width: 200px;
      height: 180px;

      padding: 0;
      line-height: 150px;
    } */

  }

  @media (max-width: 720px) {
    .sticky {
      line-height: 1.2;
      width: 130px;
      min-height: 145px;
      margin: 15px;
    }

    .sticky-content {
      width: 130px;
      min-height: 115px;
      font-size: 14px;
    }

    .dropdown-content-hide {
      width: 130px;
    }

    .dropdown-content-hide div {
      padding: 10px 10px;
    }

    /* #createStickyBtn {
      margin: 15px;
      width: 140px;
      height: 140px;
      padding: 0;
      font: 90px "Helvetica", sans-serif;
    } */

    .sticky-header-menu {
      padding: 0 10px 0 0;
      width: 25px;
      margin: 0 3px;
    }

    .drop-button {
      margin-left: auto;
    }

    .sticky-header {
      justify-content: space-around;
    }

    #sticky {
      position: absolute !important;
      z-index: 999;
    }
  }

  #toggleStickyBtn {
    position: fixed;
    bottom: 20px;
    left: 20px;
    font-size: 16px;
    padding: 10px;
    cursor: pointer;
    background-color: #fff;
    color: #eb6f45 !important;
    border: 1px solid #eb6f45;
    border-radius: 50%;
    outline: none;
    z-index: 999;
}
#toggleStickyBtn i {
  color: #eb6f45 !important;
}
</style>

<div id="main" style="position: fixed; z-index: 999;" class="hidden">
  <div class="sticky" id="sticky">
    <div class="sticky-header">
      <img src="{{asset('assets/media/pencil_3075908.png')}}" class="sticky-header-menu disk-button" alt="" />
      <img src="{{asset('assets/media/plus.png')}}" class="sticky-header-menu add-button" alt="" />
      <img src="{{asset('assets/media/checked_190411.png')}}" class="sticky-header-menu notSaved" alt="" />
      <img src="{{asset('assets/media/paint.png')}}" class="sticky-header-menu drop-button" alt="" />
      <!-- <span class="sticky-header-menu notSaved fas fa-check" title='not saved'></span> -->
      <!-- <span class="sticky-header-menu drop-button fas fa-paint-brush" title='change color'></span> -->
      <div class="dropdown-content-hide">
        <div class="pink-color"></div>
        <div class="yellow-color"></div>
        <div class="green-color"></div>
        <div class="blue-color"></div>
        <div class="purple-color"></div>
      </div>
      <img src="{{asset('assets/media/trash_6807041.png')}}" class="sticky-header-menu  remove-button" alt="" />
      <!-- <span class="sticky-header-menu remove-button fa-regular fa-trash-can" title='delete note'></span> -->
    </div>
    <textarea class="sticky-content"></textarea>
  </div>


  <div style="display:flex !important; align-items:center !important; justify-content: center !important;" id="sticky-widget-container">
    <div id="createStickyBtn" class="draggable"> <i class="fas fa-plus"></i></div>
  </div>
  </div>

  <button id="toggleStickyBtn" onclick="toggleStickyNotes()"> <i class="fas fa-book"></i></button>

<script>
  window.onload = function() {

    loadStartEvents();

    function loadStartEvents() {
      const createFirstSticky = document.querySelector("#createStickyBtn");
      document.onmouseup = hideDropMenu;
      createFirstSticky.onclick = createId;
      let isStorageEmpty = getStoredStickies(createFirstSticky);
    }

    function hideDropMenu(e) {
      let stickies = Array.from(document.querySelectorAll(".sticky"));
      let stickiesIdArray = stickies.map(el => el.getAttribute("data-id")).filter(el => el);

      for (let i = 0; i < stickiesIdArray.length; i++) {
        let dropContent = document.querySelector(`[data-id="${stickiesIdArray[i]}"] .dropdown-content-hide`);
        let dropButton = document.querySelector(`[data-id="${stickiesIdArray[i]}"] .drop-button`);
        if (dropContent != e.target.parentNode && dropButton != e.target) {
          dropContent.style.display = "none";
        }
      }
    }

    function getStoredStickies(createFirstSticky) {
      $.ajax({
        url: '/api/get-previous-notes',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          let notes = response.notes;
          if (notes.length > 0) {
            createFirstSticky.style.display = "none";
          } else {
            createFirstSticky.style.display = "block";
          }

          notes.forEach(note => {
            addStoredStickiesToDom(note);
          });
        },
        error: function(error) {
          console.error('Error fetching notes:', error);
        }
      });
    }

    function addStoredStickiesToDom(stickyObject) {
      let stickyClone = createSticky();
      Array.from(stickyClone.children).filter(
        el => el.className == "sticky-content"
      )[0].value = stickyObject.content;
      stickyClone.style.backgroundImage = stickyObject.color;
      stickyClone.setAttribute("data-id", stickyObject.id);

      $(stickyClone).draggable();

    }

    function createSticky() {
      let parent = document.querySelector("#main");
      let sticky = document.querySelector(".sticky");
      let stickyClone = sticky.cloneNode(true);
      let topBoundary = 0;
    // let rightBoundary = $(window).width() - 100;
    // console.log(rightBoundary - 200);
      parent.appendChild(stickyClone);
      stickyClone.style.display = "block";

        $(stickyClone).draggable(
          {
          containment: [0, topBoundary, $(window).width() - 300, $(window).height() - 0]}
          ) // [left, top, right, bottom]
      let newAddBtn = Array.from(
        Array.from(stickyClone.children).filter(
          el => el.className == "sticky-header"
        )[0].children
      ).filter(el => el.classList.contains("add-button"))[0];
      newAddBtn.onclick = createId;

      let removeBtn = Array.from(
        Array.from(stickyClone.children).filter(
          el => el.className == "sticky-header"
        )[0].children
      ).filter(el => el.classList.contains("remove-button"))[0];
      removeBtn.onclick = deleteSticky;

      let dropBtn = Array.from(
        Array.from(stickyClone.children).filter(
          el => el.className == "sticky-header"
        )[0].children
      ).filter(el => el.classList.contains("drop-button"))[0];
      dropBtn.onclick = toggleDropMenuClick;

      let dropMenus = Array.from(
        document.querySelectorAll(".dropdown-content-hide")
      );
      for (let dropMenu of dropMenus) {
        dropMenu.onclick = changeColor;
      }

      let stickyCloneContent = Array.from(stickyClone.children).filter(
        el => el.className == "sticky-content"
      )[0];
      stickyCloneContent.value = "";

      stickyCloneContent.onchange = storeSticky;
      stickyCloneContent.oninput = notSavedNotification;

      return stickyClone;
    }

    function createId(e) {
      if (e.target.id == "createStickyBtn") {
        e.target.style.display = "none";
      }

      if (checkNoteLimit()) {
        Snackbar.show({
        pos: 'bottom-center',
        text: 'Notes limit reached. Cannot create more notes.',
        backgroundColor: '#ea6f44',
        actionTextColor: '#fff',
        duration: 100000,
        });
        return;
    }

      $.ajax({
        url: '/api/save-note',
        type: 'POST',
        data: {
          content: ''
        },
        dataType: 'json',
        success: function(response) {
          let key = response.id;
          let stickyClone = createSticky();
          stickyClone.setAttribute("data-id", key);
        },
        error: function(error) {
          console.error('Error saving note:', error);
        }
      });
    }

    function checkNoteLimit() {
    const stickyNotes = document.querySelectorAll(".sticky");
    const createStickyBtn = document.querySelector("#createStickyBtn");

    if (stickyNotes.length >= 6) {
        Snackbar.show({
        pos: 'bottom-center',
        text: 'Notes limit reached. Cannot create more notes.',
        backgroundColor: '#ea6f44',
        actionTextColor: '#fff',
        duration: 100000,
        });
        return true;
    } else {
        return false;
    }
        }

    function deleteSticky(e) {
      const createFirstSticky = document.querySelector("#createStickyBtn");
      const main = document.querySelector("#main");
      let key = e.target.parentNode.parentNode.getAttribute("data-id");

      $.ajax({
        url: '/api/delete-note/' + key,
        type: 'DELETE',
        success: function(response) {
          removeStickyFromDOM(key);

          if (main.children.length > 2) {
            createFirstSticky.style.display = "none";
          } else {
            createFirstSticky.style.display = "block";
          }
        },
        error: function(error) {
          console.error('Error deleting note:', error);
        }
      });
    }

    function removeStickyFromDOM(key) {
      var sticky = document.querySelector(`[data-id="${key}"]`);
      sticky.parentNode.removeChild(sticky);
    }

    function toggleDropMenuClick(e) {
      let parentId = e.target.parentNode.parentNode.getAttribute("data-id");
      let stickyContent = document.querySelector(`[data-id="${parentId}"] .sticky-content`);
      let dropMenu = document.querySelector(
        `[data-id="${parentId}"] .dropdown-content-hide`
      );
      dropMenu.style.display != "flex" ?
        (dropMenu.style.display = "flex") :
        (dropMenu.style.display = "none");
    }

    function changeColor(e) {
      let colorBtn = e.target;
      let sticky = e.target.parentNode.parentNode.parentNode;
      let key = sticky.getAttribute("data-id");
      let newColor = getComputedStyle(colorBtn).backgroundImage;

      sticky.style.backgroundImage = newColor;

      $.ajax({
        url: '/api/update-note/' + key,
        type: 'PUT',
        data: {
          color: newColor
        },
        dataType: 'json',
        success: function(response) {
          // Optional: Handle success if needed
        },
        error: function(error) {
          console.error('Error updating note color:', error);
        }
      });
    }

    function storeSticky(e) {
      let stickiesArray = getStickiesArray();
      let sticky = e.target.parentNode;
      let key = sticky.getAttribute("data-id");
      let stickyContent = e.target.value;
      let oldColor = getComputedStyle(sticky).backgroundImage;

      $.ajax({
        url: '/api/update-note/' + key,
        type: 'PUT',
        data: {
          content: stickyContent,
          color: oldColor
        },
        dataType: 'json',
        success: function(response) {
          let stickyId = e.target.parentNode.getAttribute("data-id");
          let notSaved = document.querySelector(`[data-id="${stickyId}"] .notSaved`);
          notSaved.style.display = "inline-block";
          notSaved.style.color = "black";
          notSaved.title = "saved";
        },
        error: function(error) {
          console.error('Error updating note:', error);
        }
      });
    }

    function notSavedNotification(e) {
      let stickyId = e.target.parentNode.getAttribute("data-id");
      let notSaved = document.querySelector(`[data-id="${stickyId}"] .notSaved`);
      notSaved.style.display = "inline-block";
      notSaved.style.color = "red";
      notSaved.title = "not saved";
    }

    function getStickiesArray() {
      // This function can be removed as it was only used for local storage
      return [];
    }
  };

  function toggleStickyNotes() {
    const mainContainer = document.getElementById("main");
    mainContainer.classList.toggle("hidden");
}

</script>