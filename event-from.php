<?php
function event_form_shortcode() {
    ob_start();
    ?>
        <form method="post" enctype="multipart/form-data">

            <h1 style="text-align:center; color:gray">Event Submission Form</h1>
            <label> Event Title
              <input type="text" name="event_title" placeholder="Event Title" required> 
            </label><br><br>
            
            <label>Event Description
                <textarea name="event_description" placeholder="Event Description" required></textarea>
            </label><br><br>
            
            <label>Organizer Name
                <input type="text" name="organizer_name" placeholder="Organizer Name" required>
            </label><br><br>
            
            <label> Number of Participants
                <input type="number" name="participants" placeholder="Number of Participants" required>
            </label><br><br>
            
            <label>Event Location
                <input type="text" name="event_location" placeholder="Event Location" required>
            </label><br><br>
            
            <label>Additional Notes
                <textarea name="additional_notes" placeholder="Additional Notes"></textarea>
            </label><br><br>
            
            <label>Evenet Category Selection
                <select name="Category Selection" required><br><br>
                    <option value="">Select Category</option>
                    <option value="Marriage">Marriage</option>
                    <option value="Birthday">Birthday</option>
                    <option value="Seminar">Seminar</option>
                </select>
            </label><br><br>
                
            <label>Event Date & Time
                <input type="datetime-local" name="event_datetime" required>
            </label> <br><br>
            
            <label>Event Feature Image
                <input type="file" name="feature_image">
            </label><br><br>
            
             
            <input type="submit" name="submit_event" value="Submit Event">
        </form>
    <?php
    return ob_get_clean();
}
add_shortcode('event_submission_form', 'event_form_shortcode');
