<div id="question-list" class="border rounded p-2 d-flex flex-column gap-2">
    <p class="p-2 text-center">Quiz Questions</p>

    <!-- Question Items Here -->
    <div class="question-item border rounded p-2">
        <h5 class="question p-2">${number} ${text}</h5>

        <!-- Answer Form -->
        <form class="answer-form d-flex gap-2">
            <input class="border rounded p-2 w-100" type="text" name="answer" placeholder="Enter correct answer">
            <button class="btn btn-success">Add</button>
        </form>

        <div class="answer-list d-flex flex-column gap-2">
            <p class="p-2 text-center">Correct Answers</p>

            <div class="answer-item d-flex gap-2">
                <input class="border rounded p-2 w-100" type="text" name="answer" value="${text}">
                <button class="btn btn-danger">Remove</button>
            </div>
            <div class="answer-item d-flex gap-2">
                <input class="border rounded p-2 w-100" type="text" name="answer" value="${text}">
                <button class="btn btn-danger">Remove</button>
            </div>
            <div class="answer-item d-flex gap-2">
                <input class="border rounded p-2 w-100" type="text" name="answer" value="${text}">
                <button class="btn btn-danger">Remove</button>
            </div>

        </div>
    </div>

</div>