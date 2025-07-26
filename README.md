resources used
http://svgrepo.com/svg/528744/ticket

# Requirements
- [x] Anyone can open a support ticket
- [x] Guest users are allowed to open a support ticket by entering the following details.
   a. Customer Name
   b. Problem Description
   c. Email
   d. Phone Number
- [x] When submitted, a unique reference number is generated and issued to the customer.
   This reference number should be used to check the status of the ticket afterwards. An acknowledgement email is sent to the customer’s email address after ticket details
   are stored in the system.
- [ ] Support agent can check the pending tickets list

- [ ] Support agents are required to login to the system to see the tickets opened by the
   customers.
- [ ]  Tickets list has the following features
   a. Search using the customer name
   b. Pagination
   c. New tickets (ones that are not opened yet) are highlighted
   d. Support agents can open the tickets to see the ticket details.
- [ ] Support agent replies to the ticket
- [ ] Once opened, the ticket has a form which can be used to reply to the ticket.
- [ ] Reply is recorded in the system, and an email with a reply message is sent to the customer.
- [ ] Customer checks the ticket status
- [ ] Customers are allowed to check the status of their tickets by entering the reference
    number issued at opening the support ticket.
- [ ] The reply provided by the support agent must be visible on the ticket view.
## Non Functional Requirements
-  UI should be simple but responsive to fit in all screen sizes (Mobile, Tab, Desktop).
- Minimize the number of page loads required while using the system (Use AJAX where
required).
- All inputs should be properly validated and appropriate validation and status messages
should be shown when necessary.
-  System must ensure the security of the personal data. (ie. Ticket references should not
be easy to guess. etc.)
- Use the Laravel framework

--- 
## Version : 1.0.0

### Feature: Tickets
- [x] Any user can create a ticket (public route for create ticket)
- [x] User can view the ticket with reference id (public route | uuid)
- [x] Create / View pages are response

#### Assumptions: 
- After Ticket is created, the user redirects to the ticket page for better UX
