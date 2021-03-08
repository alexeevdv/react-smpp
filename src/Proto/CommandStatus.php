<?php

namespace alexeevdv\React\Smpp\Proto;

interface CommandStatus
{
    public const ESME_ROK = 0x00000000; // No Error
    public const ESME_RINVMSGLEN = 0x00000001; // Message Length is invalid
    public const ESME_RINVCMDLEN = 0x00000002; // Command Length is invalid
    public const ESME_RINVCMDID = 0x00000003; // Invalid Command ID
    public const ESME_RINVBNDSTS = 0x00000004; // Incorrect BIND Status for given command
    public const ESME_RALYBND = 0x00000005; // ESME Already in Bound State
    public const ESME_RINVPRTFLG = 0x00000006; // Invalid Priority Flag
    public const ESME_RINVREGDLVFLG = 0x00000007; // Invalid Registered Delivery Flag
    public const ESME_RSYSERR = 0x00000008; // System Error
    public const ESME_RINVSRCADR = 0x0000000A; // Invalid Source Address
    public const ESME_RINVDSTADR = 0x0000000B; // Invalid Dest Addr
    public const ESME_RINVMSGID = 0x0000000C; // Message ID is invalid
    public const ESME_RBINDFAIL = 0x0000000D; // Bind Failed
    public const ESME_RINVPASWD = 0x0000000E; // Invalid Password
    public const ESME_RINVSYSID = 0x0000000F; // Invalid System ID
    public const ESME_RCANCELFAIL = 0x00000011; // Cancel SM Failed
    public const ESME_RREPLACEFAIL = 0x00000013; // Replace SM Failed
    public const ESME_RMSGQFUL = 0x00000014; // Message Queue Full
    public const ESME_RINVSERTYP = 0x00000015; // Invalid Service Type
    public const ESME_RINVNUMDESTS = 0x00000033; // Invalid number of destinations
    public const ESME_RINVDLNAME = 0x00000034; // Invalid Distribution List name
    public const ESME_RINVDESTFLAG = 0x00000040; // Destination flag (submit_multi)
    // Invalid ‘submit with replace’ request (i.e. submit_sm with replace_if_present_flag set)
    public const ESME_RINVSUBREP = 0x00000042;
    public const ESME_RINVESMSUBMIT = 0x00000043; // Invalid esm_SUBMIT field data
    public const ESME_RCNTSUBDL = 0x00000044; // Cannot Submit to Distribution List
    public const ESME_RSUBMITFAIL = 0x00000045; // submit_sm or submit_multi failed
    public const ESME_RINVSRCTON = 0x00000048; // Invalid Source address TON
    public const ESME_RINVSRCNPI = 0x00000049; // Invalid Source address NPI
    public const ESME_RINVDSTTON = 0x00000050; // Invalid Destination address TON
    public const ESME_RINVDSTNPI = 0x00000051; // Invalid Destination address NPI
    public const ESME_RINVSYSTYP = 0x00000053; // Invalid system_type field
    public const ESME_RINVREPFLAG = 0x00000054; // Invalid replace_if_present flag
    public const ESME_RINVNUMMSGS = 0x00000055; // Invalid number of messages
    public const ESME_RTHROTTLED = 0x00000058; // Throttling error (ESME has exceeded allowed message limits)
    public const ESME_RINVSCHED = 0x00000061; // Invalid Scheduled Delivery Time
    public const ESME_RINVEXPIRY = 0x00000062; // Invalid message (Expiry time)
    public const ESME_RINVDFTMSGID = 0x00000063; // Predefined Message Invalid or Not Found
    public const ESME_RX_T_APPN = 0x00000064; // ESME Receiver Temporary App Error Code
    public const ESME_RX_P_APPN = 0x00000065; // ESME Receiver Permanent App Error Code
    public const ESME_RX_R_APPN = 0x00000066; // ESME Receiver Reject Message Error Code
    public const ESME_RQUERYFAIL = 0x00000067; // query_sm request failed
    public const ESME_RINVOPTPARSTREAM = 0x000000C0; // Error in the optional part of the PDU Body.
    public const ESME_ROPTPARNOTALLWD = 0x000000C1; // Optional Parameter not allowed
    public const ESME_RINVPARLEN = 0x000000C2; // Invalid Parameter Length.
    public const ESME_RMISSINGOPTPARAM = 0x000000C3; // Expected Optional Parameter missing
    public const ESME_RINVOPTPARAMVAL = 0x000000C4; // Invalid Optional Parameter Value
    public const ESME_RDELIVERYFAILURE = 0x000000FE; // Delivery Failure (data_sm_resp)
    public const ESME_RUNKNOWNERR = 0x000000FF; // Unknown Error
}
