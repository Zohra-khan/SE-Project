<style>
    header {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        padding: 12px 24px;
        background-color: #f8f8f8;
        border-bottom: 2px solid #800000;
    }

    .logo img {
        height: 100px;
        width: 200px;
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-left: auto;
    }

    .search-bar {
        position: relative;
    }

    .search-bar input {
        padding: 7px 14px;
        border: 2px solid pink;
        border-radius: 20px;
        width: 220px;
        color: #d63384;
    }

    .search-bar input::placeholder {
        color: #d63384;
        opacity: 0.6;
    }

    .icon-img {
        height: 30px;
        width: 30px;
        object-fit: contain;
        cursor: pointer;
    }

    .menu-button {
        background-color: white;
        color: #d63384;
        padding: 10px 22px;
        border: 2px solid #d63384;
        border-radius: 12px;
        font-weight: bold;
        cursor: pointer;
        font-size: 16px;
    }

    .menu-button:hover {
        background-color: #f8f8f8;
    }

    a {
        text-decoration: none;
    }
</style>

<header>
 <div class="logo">
  <a href="main.html">
    <img src="SoiDhaga1.png" alt="SoiDhaga Logo">
  </a>
</div>


    <div class="header-right">
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search...">
            <div id="searchResults" style="position: absolute; background: white; border: 1px solid #ccc; width: 220px; max-height: 200px; overflow-y: auto; display: none;"></div>
        </div>

        <a href="wishlist.php" target="_parent">
            <img src="heart.png" class="icon" alt="Wishlist" title="Wishlist" style="width: 24px; height: 24px;">
        </a>
        <a href="cart.php" target="_parent">
            <img src="cartpic.png" class="icon" alt="Cart" title="Cart" style="width: 24px; height: 24px;">
        </a>

        <button class="menu-button" onclick="history.back()">Back</button>
    </div>
</header>

<script>
    document.getElementById("searchInput").addEventListener("input", function () {
        const query = this.value.trim();
        const resultsBox = document.getElementById("searchResults");

        if (query.length === 0) {
            resultsBox.style.display = "none";
            resultsBox.innerHTML = "";
            return;
        }

        fetch("livesearch1.php?q=" + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
                resultsBox.innerHTML = "";
                if (data.length > 0) {
                    data.forEach(item => {
                        const div = document.createElement("div");
                        div.textContent = item.name;
                        div.style.padding = "6px";
                        div.style.cursor = "pointer";
                        div.style.borderBottom = "1px solid #eee";

                        div.addEventListener("click", () => {
                            window.location.href = item.url;
                        });

                        resultsBox.appendChild(div);
                    });
                    resultsBox.style.display = "block";
                } else {
                    resultsBox.style.display = "none";
                }
            })
            .catch(error => {
                console.error("Search error:", error);
            });
    });
</script>
