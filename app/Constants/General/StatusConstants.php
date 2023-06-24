<?php

namespace App\Constants\General;

class StatusConstants
{
    const ACTIVE = "Active";
    const INACTIVE = "Inactive";
    const CREATED = "Created";
    const STARTED = "Started";
    const APPROVED = "Approved";
    const SUSPENDED = "Suspended";
    const PENDING = "Pending";
    const COMPLETED = "Completed";
    const CONFIRMED = "Confirmed";
    const DELIVERED = "Delivered";
    const PROCESSING = "Processing";
    const CANCELLED = "Cancelled";
    const DECLINED = "Declined";
    const ENDED = "Ended";
    const DELETED = "Deleted";
    const ARCHIVED = "Archived";
    const DRAFTED = "Drafted";
    const PUBLISHED = "Published";
    const SUCCESSFUL = "Successful";
    const FAILED = "Failed";
    const SKIPPED = "Skipped";
    const RESOLVED = "Resolved";
    const VERIFIED = "Verified";
    const UNVERIFIED = "Unverified";

    const ACTIVE_OPTIONS = [
        self::ACTIVE => "Active",
        self::INACTIVE => "Inactive",
        self::PENDING => "Pending",
    ];

    const BOOL_OPTIONS = [
        1 => "Yes",
        0 => "No",
    ];

    const ORDER_STATUS = [
        "disabled" => "Placed",
    ];
}

