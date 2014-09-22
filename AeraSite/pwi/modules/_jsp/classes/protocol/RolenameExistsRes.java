/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class RolenameExistsRes extends Rpc.Data
/*    */ {
/*    */   public int retcode;
/*    */   public int zoneid;
/*    */   public int roleid;
/*    */   public int status;
/*    */   public int time;
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 22 */     os.marshal(this.retcode);
/* 23 */     os.marshal(this.zoneid);
/* 24 */     os.marshal(this.roleid);
/* 25 */     os.marshal(this.status);
/* 26 */     os.marshal(this.time);
/* 27 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 32 */     this.retcode = os.unmarshal_int();
/* 33 */     this.zoneid = os.unmarshal_int();
/* 34 */     this.roleid = os.unmarshal_int();
/* 35 */     this.status = os.unmarshal_int();
/* 36 */     this.time = os.unmarshal_int();
/* 37 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 44 */       return (RolenameExistsRes)super.clone();
/*    */     }
/*    */     catch (Exception e) {
/*    */     }
/* 48 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.RolenameExistsRes
 * JD-Core Version:    0.6.2
 */