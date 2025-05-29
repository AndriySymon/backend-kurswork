<style>
    .category-card {
        max-width: 300px;
        margin: 0 auto;
        height: 100%;
    }

    .category-card img {
        height: 180px;
        object-fit: cover;
    }

    .category-card .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .category-col {
        margin-bottom: 30px;
    }
</style>

<div class="row justify-content-center">
    <div class="col-md-3 category-col">
        <div class="card category-card">
            <img src="/images/guitar.jpg" class="card-img-top" alt="Гітари">
            <div class="card-body">
                <h5 class="card-title">Гітари</h5>
                <p class="card-text">Електро та акустичні гітари для новачків і професіоналів.</p>
                <a href="/index.php?route=category/view/1" class="btn btn-outline-primary mt-auto">Переглянути</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 category-col">
        <div class="card category-card">
            <img src="/images/drums.jpg" class="card-img-top" alt="Барабани">
            <div class="card-body">
                <h5 class="card-title">Ударні</h5>
                <p class="card-text">Барабанні установки, електронні та класичні моделі.</p>
                <a href="/index.php?route=category/view/2" class="btn btn-outline-primary mt-auto">Переглянути</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 category-col">
        <div class="card category-card">
            <img src="/images/keyboards.jpg" class="card-img-top" alt="Клавішні">
            <div class="card-body">
                <h5 class="card-title">Клавішні</h5>
                <p class="card-text">Синтезатори, піаніно та MIDI-контролери.</p>
                <a href="/index.php?route=category/view/3" class="btn btn-outline-primary mt-auto">Переглянути</a>
            </div>
        </div>
    </div>
</div>
