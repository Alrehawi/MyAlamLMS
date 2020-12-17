<form id='contactus' action='' method='post'>
    <input type='text' name='name' id='name' value='Name' maxlength="50" onFocus="if (this.value == 'Name')
                this.value = '';" onBlur="if (this.value == '')
                            this.value = 'Name';"/><br/>
    <input type='text' name='email' id='email' value='Email' maxlength="50" onFocus="if (this.value == 'Email')
                this.value = '';" onBlur="if (this.value == '')
                            this.value = 'Email';"/><br/>
    <textarea rows="6" cols="50" name='message' id='message'></textarea>
    <input type='submit' name='Submit' value='Submit' class="button highlight small"/>
</form>