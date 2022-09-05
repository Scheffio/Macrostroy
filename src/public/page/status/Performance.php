<?php

enum Performance: string
{
case OPERATIONAL = "Operational";
case DEGRADED_PERFORMANCE = "Degraded Performance";
case PARTIAL_OUTAGE = "Partial Outage";
case MAJOR_OUTAGE = "Major Outage";
case MAINTENANCE = "Maintenance";
}
