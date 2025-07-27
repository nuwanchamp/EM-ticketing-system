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
   This reference number should be used to check the status of the ticket afterward. An acknowledgement email is sent to the customer’s email address after ticket details
   are stored in the system.
- [X] Support agent can check the pending tickets list

- [X] Support agents are required to log in to the system to see the tickets opened by the
   customers.
- Tickets list has the following features
   - [X] Search using the customer name
   - [X] Pagination
   - [x] New tickets (ones that are not opened yet) are highlighted
   - [X] Support agents can open the tickets to see the ticket details.
- [x] Support agent replies to the ticket
- [x] Once opened, the ticket has a form which can be used to reply to the ticket.
- [x] Reply is recorded in the system, and an email with a reply message is sent to the customer.
- [x] Customer checks the ticket status
- [x] Customers are allowed to check the status of their tickets by entering the reference
    number issued at opening the support ticket.
- [x] The reply provided by the support agent must be visible on the ticket view.
## Non Functional Requirements
-  UI should be simple but responsive to fit in all screen sizes (Mobile, Tab, Desktop).
- Minimize the number of page loads required while using the system (Use AJAX where
required).
- All inputs should be properly validated, and appropriate validation and status messages
should be shown when necessary.
-  System must ensure the security of the personal data. (ie. Ticket references should not
be easy to guess. etc.)
- Use the Laravel framework

--- 
## Version 1.0.1

### Feature: Agents ticket assignment
- [x] Login user can be assigned to a ticket
- [x] Admin namespace
- [x] Login user has access only for assigned tickets
- [x] User acknowledged with an uuid after the ticket created
- [x] Mail contains UUID
- [x] Ticket assignment Service
- [x] New tickets (ones that are not opened yet) are highlighted in Orange

#### Assumptions
- All the login users are agents
- Logged-in user will not use the `ticket.placed` route

> [!NOTE]
> - Some class methods are public to facilitate testing purposes
> - I have ignored the Site header/Nav for now
> - Used Laravel Starter kit with minor tweaks for admin Authentication


## Version : 1.0.0

### Feature: Tickets
- [x] Any user can create a ticket (public route for create ticket)
- [x] User can view the ticket with reference id (public route | uuid)
- [x] Create / View pages are response

#### Assumptions: 
- After Ticket is created, the user redirects to the ticket page for better UX
