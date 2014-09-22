/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.Common.Octets;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class ForbidUserArg extends Rpc.Data
/*    */ {
/*    */   public byte operation;
/*    */   public int gmuserid;
/*    */   public int source;
/*    */   public int userid;
/*    */   public int time;
/*    */   public Octets reason;
/*    */ 
/*    */   public ForbidUserArg()
/*    */   {
/* 19 */     this.reason = new Octets();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 24 */     os.marshal(this.operation);
/* 25 */     os.marshal(this.gmuserid);
/* 26 */     os.marshal(this.source);
/* 27 */     os.marshal(this.userid);
/* 28 */     os.marshal(this.time);
/* 29 */     os.marshal(this.reason);
/* 30 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 35 */     this.operation = os.unmarshal_byte();
/* 36 */     this.gmuserid = os.unmarshal_int();
/* 37 */     this.source = os.unmarshal_int();
/* 38 */     this.userid = os.unmarshal_int();
/* 39 */     this.time = os.unmarshal_int();
/* 40 */     os.unmarshal(this.reason);
/* 41 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 48 */       ForbidUserArg o = (ForbidUserArg)super.clone();
/* 49 */       o.reason = ((Octets)this.reason.clone());
/* 50 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 53 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.ForbidUserArg
 * JD-Core Version:    0.6.2
 */