# Admin Panel Guide

## How to Login as Admin

1. **Default Admin Credentials:**
   - Email: `admin@hotel.com`
   - Password: `password`

2. **To create a new admin user:**
   - Register a new user normally
   - Go to database and update the `usertype` field to `'admin'` for that user
   - Or use tinker: `php artisan tinker` then `User::where('email', 'user@example.com')->update(['usertype' => 'admin']);`

## How to Add Rooms

1. Login as admin
2. Go to Dashboard
3. Click on "Rooms" in the sidebar
4. Click "Add New Room" button
5. Fill in the form:
   - Room Title (required)
   - Description (required)
   - Price per Night (required)
   - Capacity (number of guests, required)
   - Room Type (Standard, Deluxe, Suite, Presidential)
   - Upload Room Image (optional)
   - Add Amenities (comma separated)
   - Check "Available for booking" if room is ready
6. Click "Create Room"

## How to Approve Bookings

1. Login as admin
2. Go to "Bookings" in the sidebar
3. You'll see all bookings with their status
4. For pending bookings, you can:
   - Click the green checkmark button to approve (changes status to "confirmed")
   - Click "View" to see full details and approve from there
   - Click "Edit" to modify booking details

## Booking Statuses

- **Pending**: New booking, waiting for admin approval
- **Confirmed**: Approved by admin, booking is confirmed
- **Cancelled**: Booking was cancelled
- **Completed**: Stay has been completed

