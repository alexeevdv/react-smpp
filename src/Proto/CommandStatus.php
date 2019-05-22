<?php

namespace alexeevdv\React\Smpp\Proto;

interface CommandStatus
{
    const ESME_ROK = 0x00000000; // No Error
    const ESME_RINVMSGLEN = 0x00000001; // Message Length is invalid
    const ESME_RINVCMDLEN = 0x00000002; // Command Length is invalid
    const ESME_RINVCMDID = 0x00000003; // Invalid Command ID
    const ESME_RINVBNDSTS = 0x00000004; // Incorrect BIND Status for given command
    const ESME_RALYBND = 0x00000005; // ESME Already in Bound State
    const ESME_RINVPRTFLG = 0x00000006; // Invalid Priority Flag
    const ESME_RINVREGDLVFLG = 0x00000007; // Invalid Registered Delivery Flag
    const ESME_RSYSERR = 0x00000008; // System Error
    const ESME_RINVSRCADR = 0x0000000A; // Invalid Source Address
    const ESME_RINVDSTADR = 0x0000000B; // Invalid Dest Addr
    const ESME_RINVMSGID = 0x0000000C; // Message ID is invalid
    const ESME_RBINDFAIL = 0x0000000D; // Bind Failed
    const ESME_RINVPASWD = 0x0000000E; // Invalid Password
    const ESME_RINVSYSID = 0x0000000F; // Invalid System ID
    const ESME_RCANCELFAIL = 0x00000011; // Cancel SM Failed
    const ESME_RREPLACEFAIL = 0x00000013; // Replace SM Failed
    const ESME_RMSGQFUL = 0x00000014; // Message Queue Full
    const ESME_RINVSERTYP = 0x00000015; // Invalid Service Type
    const ESME_RINVNUMDESTS = 0x00000033; // Invalid number of destinations
    const ESME_RINVDLNAME = 0x00000034; // Invalid Distribution List name
    const ESME_RINVDESTFLAG = 0x00000040; // Destination flag (submit_multi)
    const ESME_RINVSUBREP = 0x00000042; // Invalid ‘submit with replace’ request (i.e. submit_sm with replace_if_present_flag set)
    const ESME_RINVESMSUBMIT = 0x00000043; // Invalid esm_SUBMIT field data
    const ESME_RCNTSUBDL = 0x00000044; // Cannot Submit to Distribution List
    const ESME_RSUBMITFAIL = 0x00000045; // submit_sm or submit_multi failed
    const ESME_RINVSRCTON = 0x00000048; // Invalid Source address TON
    const ESME_RINVSRCNPI = 0x00000049; // Invalid Source address NPI
    const ESME_RINVDSTTON = 0x00000050; // Invalid Destination address TON
    const ESME_RINVDSTNPI = 0x00000051; // Invalid Destination address NPI
    const ESME_RINVSYSTYP = 0x00000053; // Invalid system_type field
    const ESME_RINVREPFLAG = 0x00000054; // Invalid replace_if_present flag
    const ESME_RINVNUMMSGS = 0x00000055; // Invalid number of messages
    const ESME_RTHROTTLED = 0x00000058; // Throttling error (ESME has exceeded allowed message limits)
    const ESME_RINVSCHED = 0x00000061; // Invalid Scheduled Delivery Time
    const ESME_RINVEXPIRY = 0x00000062; // Invalid message (Expiry time)
    const ESME_RINVDFTMSGID = 0x00000063; // Predefined Message Invalid or Not Found
    const ESME_RX_T_APPN = 0x00000064; // ESME Receiver Temporary App Error Code
    const ESME_RX_P_APPN = 0x00000065; // ESME Receiver Permanent App Error Code
    const ESME_RX_R_APPN = 0x00000066; // ESME Receiver Reject Message Error Code
    const ESME_RQUERYFAIL = 0x00000067; // query_sm request failed
    const ESME_RINVOPTPARSTREAM = 0x000000C0; // Error in the optional part of the PDU Body.
    const ESME_ROPTPARNOTALLWD = 0x000000C1; // Optional Parameter not allowed
    const ESME_RINVPARLEN = 0x000000C2; // Invalid Parameter Length.
    const ESME_RMISSINGOPTPARAM = 0x000000C3; // Expected Optional Parameter missing
    const ESME_RINVOPTPARAMVAL = 0x000000C4; // Invalid Optional Parameter Value
    const ESME_RDELIVERYFAILURE = 0x000000FE; // Delivery Failure (data_sm_resp)
    const ESME_RUNKNOWNERR = 0x000000FF; // Unknown Error
}
